package magnolia

import net.sourceforge.openutils.mgnlmedia.media.tags.el.MediaEl

class MagnoliaMediaTagLib {
    static namespace = "mgnlmedia"

    def url = {attrs ->
        def content = attrs.content
        out << MediaEl.url(content)
    }

    def resImage = {attrs ->
        def content = attrs.content
        def resolution = attrs.resolution
        out << MediaEl.urlres(content, resolution)
    }

}