package gdomain
class SlideShowImage extends Image{
    Integer displayOrder
    String message

    public String toString(){
        return altText
    }
    static belongsTo = [slideShow:SlideShow]
    static constraints = {
    }
}
