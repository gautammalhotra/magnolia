package gdomain

class TechAndTool {
    String name
    String category
    String type
    Integer priority
    String url
    Integer displayOrder
    
    static constraints = {
        name(nullable: false, blank: false)
        category(nullable: false, inList: ['testing','development','communication','infrastructure','system','planning','tracking','ci/vcs'])
        type(nullable: false, inList:['tool','technology','plugin'])
        priority(nullable: false,inList:0..3)
        url(nullable: false)
        displayOrder(nullable: false, inList: 1..50)
    }
}
