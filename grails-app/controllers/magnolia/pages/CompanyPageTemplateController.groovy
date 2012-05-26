package magnolia.pages

import info.magnolia.module.blossom.dialog.TabBuilder
import magnolia.components.HomePageBannerController
import magnolia.components.HomePageController
import magnolia.components.StaticHtmlController
import info.magnolia.module.blossom.annotation.*

@Template(id = "grailsModule:pages/companyPageTemplate", title = "Company Page Template")
class CompanyPageTemplateController {

    def index() {
        render view: '/magnolia/companyPageTemplate'
    }

    @TabFactory("Content")
    public void propertiesDialog(TabBuilder settings) {
        settings.addEdit("title", "Page title", "");
        settings.addEdit("metaDescription", "Meta description", "");
        settings.addEdit("metaKeywords", "Meta keywords", "");
    }

    @Area("companyPageArea")
    @Inherits
    @AvailableComponentClasses([HomePageBannerController.class, HomePageController.class, StaticHtmlController.class])
    static class CompanyPageAreaController {

        def index = {
            render view: "/magnolia/componentIterator"
        }
    }
}