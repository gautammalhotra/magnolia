package magnolia.components

import info.magnolia.cms.gui.dialog.Dialog
import info.magnolia.module.blossom.annotation.TabFactory
import info.magnolia.module.blossom.annotation.Template
import info.magnolia.module.blossom.annotation.TemplateDescription
import info.magnolia.module.blossom.dialog.DialogCreationContext
import info.magnolia.module.blossom.dialog.TabBuilder
import magnolia.TabBuilderUtils

@Template(id = "grailsModule:components/homePageBanner", title = "Home Page Banner")
@TemplateDescription("Home Page Banner")
class HomePageBannerController {

    def index() {
        render view: '/magnolia/homePageBanner'
    }

    @TabFactory("homePageBanner")
    public void addDialog(TabBuilder builder, Dialog dialog, DialogCreationContext context) {
        TabBuilderUtils.addDialogSelectModal(context, builder, "homePageImage",
                "Home Page Image", "Main large image")
    }
}
