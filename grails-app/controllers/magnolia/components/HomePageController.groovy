package magnolia.components

import info.magnolia.module.blossom.annotation.TemplateDescription
import info.magnolia.module.blossom.annotation.Template
import info.magnolia.cms.gui.dialog.Dialog
import info.magnolia.module.blossom.annotation.TabFactory
import info.magnolia.module.blossom.dialog.DialogCreationContext
import info.magnolia.module.blossom.dialog.TabBuilder

@Template(id = "grailsModule:components/homePage", title = "Home Page")
@TemplateDescription("Home Page")
class HomePageController {

    def index() {
//        println content.aboutUs
//        println content.ourServices
//        println content.ourWork
        render view: '/magnolia/homePage'
    }

    @TabFactory("homePage")
    public void addDialog(TabBuilder articleSettings, Dialog dialog, DialogCreationContext context) {
        articleSettings.with() {
            addTextArea('aboutUs', "About us", "About us", 50)
            addTextArea('ourServices', "Our Services", "Our services", 50)
            addTextArea('ourWork', "Our Work", "Our work", 50)
        }
    }
}
