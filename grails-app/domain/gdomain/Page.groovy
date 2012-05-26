package gdomain
abstract class Page {
    String title
    String metatag
    String metaKeywords
    static belongsTo = [section:Section]

    static constraints = {
        metaKeywords(nullable:true)
        metatag maxSize:1000
    }
}
