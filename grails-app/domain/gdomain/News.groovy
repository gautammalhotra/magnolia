package gdomain
class News {

    String heading
    String text
    String link
    String displayOrder

    static constraints = {
        text(nullable:true)
    }
}
