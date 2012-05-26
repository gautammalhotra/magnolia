package magnolia.pages

import info.magnolia.module.blossom.dialog.TabBuilder
import info.magnolia.module.blossom.annotation.*
import magnolia.components.ArticleShowController
import magnolia.components.ArticleTeaserController
import magnolia.components.StaticHtmlController

@Template(id = "grailsModule:pages/articleTemplate", title = "Article Page template")
class ArticleTemplateController {

    def index() {
        render view: '/magnolia/articleTemplate'
    }

    @TabFactory("Content")
    public void propertiesDialog(TabBuilder settings) {
        settings.addEdit("title", "Page title", "");
        settings.addEdit("metaDescription", "Meta description", "");
        settings.addEdit("metaKeywords", "Meta keywords", "");
    }

    @Area("articleArea")
    @Inherits
    @AvailableComponentClasses([ArticleShowController.class, ArticleTeaserController.class, StaticHtmlController.class])
    static class ArticleAreaController {

        def index = {
            render view: "/magnolia/componentIterator"
        }
    }
}
