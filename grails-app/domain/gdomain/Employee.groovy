package gdomain

class Employee {
    String name
    String designation
    String description
    Image image
    String team
    Integer displayOrder

    static constraints = {
        description(maxSize: 1000)
        team(nullabe:true)
    }

}
