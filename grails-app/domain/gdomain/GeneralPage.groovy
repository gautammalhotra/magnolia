package gdomain

class GeneralPage extends Page{


    String header
    String content

    static constraints = {
        content maxSize:10000
    }
}
