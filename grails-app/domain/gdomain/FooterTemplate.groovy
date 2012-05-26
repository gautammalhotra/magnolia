package gdomain

import magnolia.IGConstants


class FooterTemplate {
    String slot1
    String slot2
    String slot3
    String slot4

    static constraints = {
        slot1(inList: IGConstants.TEMPLATES)
        slot2(inList: IGConstants.TEMPLATES)
        slot3(inList: IGConstants.TEMPLATES)
        slot4(inList: IGConstants.TEMPLATES)
    }
}
