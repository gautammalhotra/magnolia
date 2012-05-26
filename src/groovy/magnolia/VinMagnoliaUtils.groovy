package magnolia


import info.magnolia.cms.core.Content
import info.magnolia.link.LinkUtil
import info.magnolia.module.blossom.support.RepositoryUtils
import info.magnolia.cms.core.HierarchyManager
import info.magnolia.context.MgnlContext
import info.magnolia.cms.beans.config.ContentRepository
import javax.jcr.RepositoryException
import info.magnolia.cms.core.MetaData

class VinMagnoliaUtils {

    public static Content getWebsiteContentByNodePath(String nodePath) {
        try {
            HierarchyManager hierarchyManager = MgnlContext.getSystemContext().getHierarchyManager(ContentRepository.WEBSITE);
            return hierarchyManager.getContent(nodePath);
        } catch (RepositoryException e) {
            return null;
        }
    }

    public static List calculateMaxAndOffset(String range, int max, int offset) {
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

    public static String convertUuidToUrl(String uuid) {
        Content redirectContent = convertUuidToWebsiteContent(uuid);
        LinkUtil.createAbsoluteLink(redirectContent);
    }

    public static Content convertUuidToWebsiteContent(String uuid) {
        return RepositoryUtils.getWebsiteContentByUuid(uuid)
    }

    public static List<Content> extractSubList(List<Content> leafs, int max, int offset) {
        if (leafs.size() > max) {
            leafs = leafs[offset..max]
        }
        return leafs
    }

    public static List<ArticleTeaserVO> convertToArticleTeasers(List<Content> leafs) {
        List<ArticleTeaserVO> teasers = []
        leafs.eachWithIndex {leaf, index ->
            if (leaf.hasContent('articleArea')) {
                def children = leaf.getContent('articleArea').getChildByName("0")
                def child = children ? children : null
                if (child) {
                    ArticleTeaserVO teaserVO = covertNodeToTeaser(leaf, child)
                    println teaserVO?.title
                    teasers << teaserVO
                }
            }
        }
        return teasers
    }

    public static ArticleTeaserVO covertNodeToTeaser(Content leaf, Content child) {
        MetaData articleContentMetaData = fetchPageMetaData(leaf.getUUID())
        ArticleTeaserVO teaserVO = new ArticleTeaserVO()
        teaserVO.with {
            title = child.getNodeData('articleHeading').string
            teaser = child.getNodeData('articleTeaser').string
            subHeading = child.getNodeData('articleSubHeading').string
            articleUrl = leaf.getHandle() + ".html"
            imageUrl = child.getNodeData('mainArticleImage').string
            author = child.getNodeData('articleAuthor').string ?: articleContentMetaData.authorId
            shortTeaser = child.getNodeData('articleShortTeaser').string
            shortHeading = child.getNodeData('articleShortHeading').string
        }
        return teaserVO
    }

    public static MetaData fetchPageMetaData(String uuid) {
        Content articleContent = RepositoryUtils.getWebsiteContentByUuid(uuid);
        MetaData articleContentMetaData = articleContent.getMetaData()
        return articleContentMetaData
    }

    public static List<MagnoliaContentVO> fetchAllMagnoliaPages() {
        Content root = getWebsiteRootNode()
        List<MagnoliaContentVO> allPages = fetchAllChildrenRecurse(root)
        allPages
    }

    private static Content getWebsiteRootNode() {
        HierarchyManager hierarchyManager = MgnlContext.getSystemContext().getHierarchyManager(ContentRepository.WEBSITE);
        Content root = hierarchyManager.getRoot()
        return root
    }

    public static List<MagnoliaContentVO> fetchAllChildrenRecurse(Content node) {
        List<MagnoliaContentVO> contents = []
        if (node.hasChildren()) {
            node.children.each {Content child ->
                contents << new MagnoliaContentVO(child)
                contents.addAll(fetchAllChildrenRecurse(child))
            }
        }
        contents
    }
}
