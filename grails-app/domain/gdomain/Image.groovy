package gdomain
class Image {
    String title
    String altText
    byte[] igImage

    public String toString(){
         return altText

    }

    static constraints = {
        title nullable: true
        igImage maxSize: 50000000, nullable: true
    }
}