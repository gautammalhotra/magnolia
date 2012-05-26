package gdomain

class CaseStudy {
    String title
    String url
    String summary
    String description
    String displayOrder

    static constraints = {
        summary(maxSize: 4000)
        description(maxSize: 10000)
    }
}
