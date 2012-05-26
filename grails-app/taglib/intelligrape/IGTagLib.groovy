package intelligrape

import org.codehaus.groovy.grails.commons.ConfigurationHolder
import gdomain.Section
import gdomain.Testimonial

public class IGTagLib {
     static namespace = "IG"
     def utilService
     List nonGeneralPages = ["home","team","contact"]
    /** This functions retreives the sections
     *  displays the main sections first & then add subsections to them
     */

    def siteSubSections = { attrs,body ->
        Section section = attrs.section
        List subSections = com.intelligrape.gdomain.Section.findAllWhere(parentSection:section).sort{it.displayOrder}
         if(subSections){
            out<< '<ul class="sub_menu">'
            subSections.each{subSection->
               List nestedSubsections = com.intelligrape.gdomain.Section.findAllWhere(parentSection:subSection)
                if(nestedSubsections){
                    out<< "<li>" + generateLink(section:subSection) +siteSubSections(section:subSection) +"</li>"
                }
                else{
                    out<< "<li>" + generateLink(section:subSection) +"</li>"
                }
            }
            out<< '</ul>'
        }
    }

    def testimonial ={attrs, body ->
        Testimonial testimonialInstance = com.intelligrape.gdomain.Testimonial.listOrderByDisplayOrder(max:1,cache:true)[0]
        out << '''<div class="grid_3 footblock  clients">
            <div class="child">
                <p class="testimonial">''' + testimonialInstance?.quote
        if(testimonialInstance?.client)
            out<<" - by: " +testimonialInstance?.client
        out<< "</p></div> </div>"
    }
    def recentPosts={attrs, body->
        Integer numberOfPosts = attrs.numberOfPosts?attrs.numberOfPosts.toInteger():null
        if(attrs.template?.equals('recentBlogs')){
                if(numberOfPosts){
                    out << render(template:'/shared/recentBlogs', model:[recentBlogs:ConfigurationHolder.config.recentBlogsShortDesc?.getAt(0..numberOfPosts) ])
                }
                else{
                    out << render(template:'/shared/recentBlogs', model:[recentBlogs:ConfigurationHolder.config.recentBlogsShortDesc])
                }
        }
        else
            out << render(template:'/shared/recentBlogsWithoutImage', model:[recentPosts:ConfigurationHolder.config.recentBlogsLongDesc ])
    }
    
    def generateLink={attrs ->        
        if(nonGeneralPages.contains(attrs.section.navUrl)){
            out<< link(controller:"ig", action:utilService.getActionNameForSection(attrs.section.navUrl), title: attrs.section.title){"<span>"+attrs.section.name+"</span>"}
        }
        else if(attrs.section.navUrl == 'blog'){
            out<< link(uri: '/blog', title: attrs.section.title){"<span>"+attrs.section.name+"</span>"}
        }
        else
            out<< link(controller:"ig", action:utilService.getActionNameForSection(attrs.section.navUrl),
                    params:[generalPageURL:attrs.section.navUrl+".html"], title: attrs.section.title){"<span>"+attrs.section.name+"</span>"}
    }

    def trim = {attrs ->
        String body = attrs.body
        if(body.length()<1000){
            out << body
        }
        else{
            out << body.substring(0,1000) + "..."
        }
    }

    def imageLink = {attrs ->
        String id=attrs['image'].id;
        String version=attrs['image'].version;
        String src=g.createLink(controller:"image",action:"showImage",params:[id:id,version:version])
        if(attrs['mime']){
           String mime=attrs['mime'];
           out<<src+"&mime="+mime;
        }
        else{
           out<<src
        }



    }
}
