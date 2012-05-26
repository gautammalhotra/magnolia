package magnolia

import info.magnolia.cms.core.Content

class MagnoliaContentVO {
    String uuid
    String url

    MagnoliaContentVO(Content page) {
        uuid = page.UUID
        url = page.handle + ".html"
    }
}
