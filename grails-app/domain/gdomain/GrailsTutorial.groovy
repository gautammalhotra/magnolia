package gdomain

class GrailsTutorial {
    String title
    String url
    String description
    String displayOrder
    byte[] pdf

    static constraints = {
        pdf(maxSize: 10 * 1024 * 1024)
    }
}
