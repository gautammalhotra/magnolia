package magnolia

import info.magnolia.cms.gui.dialog.DialogFactory
import info.magnolia.module.blossom.dialog.DialogCreationContext
import info.magnolia.module.blossom.dialog.RuntimeRepositoryException
import info.magnolia.module.blossom.dialog.TabBuilder
import javax.jcr.RepositoryException
import net.sourceforge.openutils.mgnlmedia.media.dialog.DialogSelectMedia

class TabBuilderUtils {

    public static DialogSelectMedia addDialogSelectModal(DialogCreationContext context, TabBuilder paragraphSettings, String name, String label, String description) {
        try {
            DialogSelectMedia dialogSelectMedia = (DialogSelectMedia) DialogFactory
                    .getDialogControlInstanceByName(
                    context.getRequest(),
                    context.getResponse(),
                    context.getWebsiteNode(),
                    context.getConfigNode(),
                    "mediaSelection");
            dialogSelectMedia.name = name
            dialogSelectMedia.label = label;
            dialogSelectMedia.description = description;
            paragraphSettings.getTab().addSub(dialogSelectMedia)
            return dialogSelectMedia
        } catch (RepositoryException e) {
            throw new RuntimeRepositoryException(e);
        }
    }

}
