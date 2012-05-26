package gdomain
class IGInfoTemplate {

    Image image
    String description
    String link
    String title
    String header

    public String toString(){
        return image.altText
    }


    static constraints = {
        description(maxSize: 3000)
        title(nullable:true)
        header(nullable:true)
    }
}
