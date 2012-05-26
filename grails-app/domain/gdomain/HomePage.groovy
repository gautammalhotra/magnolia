package gdomain

class HomePage extends Page{

    String message
    SlideShow slideShow
    IGInfoTemplate template1
    IGInfoTemplate template2
    IGInfoTemplate template3
    RecentBlogTemplate template4

    static constraints = {
        slideShow nullable:true
        template1 nullable:true
        template2 nullable:true
        template3 nullable:true
        template4 nullable:true
    }
}
