package magnolia.components

import info.magnolia.cms.core.Content
import info.magnolia.module.blossom.annotation.TabFactory
import info.magnolia.module.blossom.annotation.Template
import info.magnolia.module.blossom.annotation.TemplateDescription
import info.magnolia.module.blossom.dialog.TabBuilder
import magnolia.ArticleTeaserVO

@Template(id = "grailsModule:components/articleTeaser", title = "Article teaser")
@TemplateDescription("Articles")
class ArticleTeaserController {
    def articleTeaserParagraphService

    def index() {
        Content mainContent = articleTeaserParagraphService.findMainContent()
        List<Content> leafs = articleTeaserParagraphService.extractSubLeaf(mainContent, content.range as String)
        List<ArticleTeaserVO> teasers = articleTeaserParagraphService.convertToArticleTeasers(leafs)
        render view: '/magnolia/articleTeaser', model: [teasers: teasers]
    }

    @TabFactory("Article Teasers - Simple Article Teaser")
    public void addDialog(TabBuilder articlesTeaserParagraphSettings) {
        articlesTeaserParagraphSettings.with {
            addEdit("title", "Edit", "Heading for the paragraph")   // needs validation
            addUuidLink("category", "Article to startCategory Or Article", "Heading for the paragraph")   // needs validation
            addEdit("range", "Article Range",
                    "E.g. 1-5 will show the latest 1 to 5 articles or 6 will show the latest 6 articles")   // needs validation
        }
    }
}
