package gdomain
class Testimonial {

    String quote
    String client
    Image image
    Integer displayOrder=0

    static constraints = {
        client (nullable:true)
        image (nullable:true)
        quote (maxSize:512)
    }
}