package magnolia.components

import info.magnolia.cms.core.AggregationState
import info.magnolia.cms.gui.dialog.Dialog
import info.magnolia.cms.gui.dialog.DialogTab
import info.magnolia.context.MgnlContext
import info.magnolia.module.blossom.annotation.TabFactory
import info.magnolia.module.blossom.annotation.TabValidator
import info.magnolia.module.blossom.annotation.Template
import info.magnolia.module.blossom.annotation.TemplateDescription
import info.magnolia.module.blossom.dialog.DialogCreationContext
import info.magnolia.module.blossom.dialog.TabBuilder
import magnolia.TabBuilderUtils

@Template(id = "grailsModule:components/articleShow", title = "Articles")
@TemplateDescription("Articles")
class ArticleShowController {
 def articleService
    def index() {
        AggregationState aggregationState = MgnlContext.getAggregationState();
        def mainContent = aggregationState.getMainContent()
        String articleUUID = mainContent.getUUID()
        render view: '/magnolia/articleShow',model:[articleUUID:articleUUID]
    }

    @TabFactory("Content")
    public void addDialog(TabBuilder articleSettings, Dialog dialog, DialogCreationContext context) {
        articleSettings.with() {
            addEdit("articleHeading", "Article Heading", "Heading Value")
            addEdit("articleSubHeading", "Article Sub heading", "Sub heading Value")
            addTextArea("articleTeaser", "Aerticle Teaser", "Enter Teaser", 5);
            addFckEditor("articleBody", "Article Body", "Article Body Value");
            addEdit("articleAuthor", "Article Author", "Author value")
//            addEdit("photograpAuthor", 'Photographer Author', "Photographer Author Value")
            addTextArea("articleShortTeaser", "Short Teaser", "Short Teaser Value", 3);
            addEdit("articleShortHeading", 'Short Heading', "Short Headind Value")
            TabBuilderUtils.addDialogSelectModal(context, articleSettings, "mainArticleImage",
                         "Article Image", "Main large image. Thumbnails for required sizes will be autogenerated")
           }
    }

    @TabValidator("Content")
    public void validate(DialogTab dialogTab) {
        articleService.validateArticle(dialogTab)
    }
}
