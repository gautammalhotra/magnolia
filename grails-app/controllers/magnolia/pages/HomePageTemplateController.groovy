package magnolia.pages

import info.magnolia.module.blossom.annotation.Template
import info.magnolia.module.blossom.annotation.TabFactory
import info.magnolia.module.blossom.dialog.TabBuilder
import info.magnolia.module.blossom.annotation.Area
import info.magnolia.module.blossom.annotation.Inherits
import info.magnolia.module.blossom.annotation.AvailableComponentClasses
import magnolia.components.StaticHtmlController
import magnolia.components.HomePageBannerController
import magnolia.components.HomePageController

@Template(id = "grailsModule:pages/homePageTemplate", title = "Home Page Template")
class HomePageTemplateController {

    def index() {
        render view: '/magnolia/homePageTemplate'
    }

    @TabFactory("Content")
    public void propertiesDialog(TabBuilder settings) {
        settings.addEdit("title", "Page title", "");
        settings.addEdit("metaDescription", "Meta description", "");
        settings.addEdit("metaKeywords", "Meta keywords", "");
    }

    @Area("homePageAreaMain")
    @Inherits
    @AvailableComponentClasses([HomePageBannerController.class, HomePageController.class, StaticHtmlController.class])
    static class HomePageAreaMainController {

        def index = {
            render view: "/magnolia/componentIterator"
        }
    }
    @Area("homePageAreaBelow")
    @Inherits
    @AvailableComponentClasses([HomePageController.class, StaticHtmlController.class])
    static class HomePageAreaBelowController {

        def index = {
            render view: "/magnolia/componentIterator"
        }
    }
}