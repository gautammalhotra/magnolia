package magnolia.components

import info.magnolia.module.blossom.annotation.TemplateDescription
import info.magnolia.module.blossom.annotation.Template
import info.magnolia.cms.gui.dialog.Dialog
import info.magnolia.module.blossom.annotation.TabFactory
import info.magnolia.module.blossom.dialog.DialogCreationContext
import info.magnolia.module.blossom.dialog.TabBuilder

@Template(id = "grailsModule:components/staticHtml", title = "Static html")
@TemplateDescription("Static Html")
class StaticHtmlController {

    def index() {
        render view: '/magnolia/staticHtml', model: [html: content.html]
    }

    @TabFactory("staticHtml")
    public void addDialog(TabBuilder articleSettings, Dialog dialog, DialogCreationContext context) {
        articleSettings.with() {
            addTextArea('html', "HTML", "Any html", 50)
        }
    }
}
