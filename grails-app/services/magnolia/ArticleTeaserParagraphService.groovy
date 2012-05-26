package magnolia

import com.altaworks.magnolia.MagnoliaUtils
import info.magnolia.cms.core.AggregationState
import info.magnolia.cms.core.Content
import info.magnolia.context.MgnlContext
import info.magnolia.module.blossom.support.RepositoryUtils
import info.magnolia.cms.gui.dialog.DialogEdit
import info.magnolia.cms.gui.dialog.DialogUUIDLink
import info.magnolia.cms.util.AlertUtil
import org.apache.commons.lang.StringUtils
import info.magnolia.cms.gui.dialog.DialogTab

class ArticleTeaserParagraphService {
    def messageSource


    public Content findMainContent() {
        AggregationState aggregationState = MgnlContext.getAggregationState();
        Content mainContent
        if (RepositoryUtils.hasNodeData(RepositoryUtils.getLocalContentNode(), "category")) {
            mainContent = RepositoryUtils.getWebsiteContentByUuid(RepositoryUtils.getLocalNodeData("category"));
        } else {
            mainContent = aggregationState.getMainContent();
        }
        return mainContent
    }

    public List<Content> extractSubLeaf(Content mainContent, String range) {
        List<Content> leafs = MagnoliaUtils.getPageLeafs(mainContent) ?: [mainContent];
        MagnoliaUtils.sortContentAfterCreationDate(leafs, false);
//        String range = contentMap.range
        Integer offset = 0
        Integer max = leafs.size() - 1
        (max, offset) = calculateMaxAndOffset(range, max, offset)
        leafs = extractSubList(leafs, max, offset)
        return leafs
    }

    private List<Content> extractSubList(List<Content> leafs, int max, int offset) {
        if (leafs.size() > max) {
            leafs = leafs[offset..max]
        }
        return leafs
    }


    public List<ArticleTeaserVO> convertToArticleTeasers(List<Content> leafs, Boolean isImagePositionMatters = false, String imagePosition = null) {
        List<ArticleTeaserVO> teasers = VinMagnoliaUtils.convertToArticleTeasers(leafs)
        // Mark image postions
        if (isImagePositionMatters) {
//            String imagePosition = contentMap.imagePosition
            teasers.eachWithIndex {teaser, i ->
                if (imagePosition == "Right") {
                    teaser.showImageOnLeft = false
                } else if (imagePosition == "Left") {
                    teaser.showImageOnLeft = true
                } else {
                    teaser.showImageOnLeft = (i % 2 == 0)
                }
            }
        }
        return teasers
    }


    private List calculateMaxAndOffset(String range, int max, int offset) {
        if (range) {
            if (range.contains('-')) {
                offset = range.tokenize('-').first().toInteger() - 1
                max = range.tokenize('-').last().toInteger() - 1
            } else {
                max = range.toInteger() - 1
            }
        }
        return [max, offset]
    }

    public void articleTeaserValidation(DialogTab dialogTab) {
        DialogEdit range = (DialogEdit) dialogTab.getSub("range");
        DialogUUIDLink category = (DialogUUIDLink) dialogTab.getSub("category");
        if (StringUtils.isEmpty(range.getValue()) && StringUtils.isBlank(range.getValue())) {
            AlertUtil.setMessage(messageSource.getMessage('article.teaser.range.error.label', null, 'You need to enter a range !', null));
        }
        if (StringUtils.isEmpty(category.getValue()) && StringUtils.isBlank(category.getValue())) {
            AlertUtil.setMessage(messageSource.getMessage('article.teaser.category.error.label', null, 'You need to select a category for fetching latest article !', null));
        }
    }

}
