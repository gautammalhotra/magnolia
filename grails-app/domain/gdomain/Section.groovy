package gdomain
class Section {

    String name
    Integer displayOrder
    Section parentSection
    String navUrl
    Boolean displayOnNavigation = true
    String title=""

    public String toString(){
        return name
    }
    static constraints = {
        title(nullable:true)
    }
}
