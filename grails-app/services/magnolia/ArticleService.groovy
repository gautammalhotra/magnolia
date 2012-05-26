package magnolia


import info.magnolia.cms.gui.dialog.DialogEdit
import info.magnolia.cms.gui.dialog.DialogTab
import info.magnolia.cms.util.AlertUtil
import org.apache.commons.lang.StringUtils
import info.magnolia.module.fckeditor.dialogs.FckEditorDialog
import net.sourceforge.openutils.mgnlmedia.media.dialog.DialogSelectMedia

class ArticleService {
    def messageSource
    def grailsApplication

    public void validateArticle(DialogTab dialogTab) {
        String validationMessage = ""
        validationMessage += validateArticleHeading(dialogTab) ?: ""
        validationMessage += validateArticleSubHeading(dialogTab) ?: ""
        validationMessage += validateArticleShortHeading(dialogTab) ?: ""
        validationMessage += validateArticleShortTeaser(dialogTab) ?: ""
        validationMessage += validateArticleTeaser(dialogTab) ?: ""
        validationMessage += validateArticleBody(dialogTab) ?: ""
        validationMessage += validateArticleImage(dialogTab) ?: ""
        validate(validationMessage)
    }

    public void validate(String validationMessage) {
        if (validationMessage) {
            AlertUtil.setMessage(validationMessage)
        }
    }

    public String validateArticleHeading(DialogTab dialogTab) {
        DialogEdit articleHeading = (DialogEdit) dialogTab.getSub("articleHeading")
        if (StringUtils.isEmpty(articleHeading.getValue()) && StringUtils.isBlank(articleHeading.getValue())) {
            return "- " + messageSource.getMessage('article.heading.empty.error.label', null, 'You need to enter an article heading !', null) + "\n"
        }
    }

    public String validateArticleSubHeading(DialogTab dialogTab) {
        DialogEdit articleSubHeading = (DialogEdit) dialogTab.getSub("articleSubHeading")
        if (StringUtils.isEmpty(articleSubHeading.getValue()) && StringUtils.isBlank(articleSubHeading.getValue())) {
            return "- " + messageSource.getMessage('article.sub.heading.empty.error.label', null, 'You need to enter sub heading !', null) + "\n"
        }
    }

    public String validateArticleShortHeading(DialogTab dialogTab) {
        DialogEdit articleShortHeading = (DialogEdit) dialogTab.getSub("articleShortHeading")
        if (StringUtils.isEmpty(articleShortHeading.getValue()) && StringUtils.isBlank(articleShortHeading.getValue())) {
            return "- " + messageSource.getMessage('article.shortHeading.empty.error.label', null, 'You need to enter article short heading !', null) + "\n"
        }
        Integer articleShortHeadingMaxLength = grailsApplication.config.article.shortHeading.max.length
        if (StringUtils.length(articleShortHeading.getValue()) > articleShortHeadingMaxLength) {
            return "- " + messageSource.getMessage('article.shortHeading.min.number.of.char.error.label', [articleShortHeadingMaxLength] as Object[], "Article short heading should not be more than ${articleShortHeadingMaxLength} characters !", null) + "\n"
        }
    }

    public String validateArticleShortTeaser(DialogTab dialogTab) {
        DialogEdit articleShortTeaser = (DialogEdit) dialogTab.getSub("articleShortTeaser")
        if (StringUtils.isEmpty(articleShortTeaser.getValue()) && StringUtils.isBlank(articleShortTeaser.getValue())) {
            return "- " + messageSource.getMessage('article.short.teaser.empty.error.label', null, 'You need to enter article short teaser !', null) + "\n"
        }
        Integer articleShortTeaserMaxLength = grailsApplication.config.article.shortTeaser.max.length
        if (StringUtils.length(articleShortTeaser.getValue()) > articleShortTeaserMaxLength) {
            return "- " + messageSource.getMessage('article.short.teaser.min.number.char.error.label', [articleShortTeaserMaxLength] as Object[], "Article short teaser canot be more than ${articleShortTeaserMaxLength} characters !", null) + "\n"
        }
    }

    public String validateArticleTeaser(DialogTab dialogTab) {
        DialogEdit articleTeaser = (DialogEdit) dialogTab.getSub("articleTeaser")
        if (StringUtils.isEmpty(articleTeaser.getValue()) && StringUtils.isBlank(articleTeaser.getValue())) {
            return "- " + messageSource.getMessage('article.teaser.empty.error.label', null, 'You need to enter article teaser !', null) + "\n"
        }
        Integer articleTeaserMaxLength = grailsApplication.config.article.teaser.max.length
        if (StringUtils.length(articleTeaser.getValue()) > articleTeaserMaxLength) {
            return "- " + messageSource.getMessage('article.teaser.min.number.char.error.label', [articleTeaserMaxLength] as Object[], "Article teaser should not be more than ${articleTeaserMaxLength} characters !", null) + "\n"
        }
    }

    public String validateArticleBody(DialogTab dialogTab) {
        FckEditorDialog articleBody = (FckEditorDialog) dialogTab.getSub("articleBody")
        if (StringUtils.isEmpty(articleBody.getValue()) && StringUtils.isBlank(articleBody.getValue())) {
            return "- " + messageSource.getMessage('article.body.empty.error.label', null, 'You need to enter article body !', null) + "\n"
        }
    }

    public String validateArticleImage(DialogTab dialogTab) {
        DialogSelectMedia dialogFileImage = (DialogSelectMedia) dialogTab.getSub("mainArticleImage")
        if (StringUtils.isEmpty(dialogFileImage.getValue()) && StringUtils.isBlank(dialogFileImage.getValue())) {
            return "- " + messageSource.getMessage('article.image.empty.error.label', null, 'You need to select article image !', null) + "\n"
        }
    }
}
