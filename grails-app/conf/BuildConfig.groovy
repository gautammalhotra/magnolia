grails.servlet.version = "2.5" // Change depending on target container compliance (2.5 or 3.0)
grails.project.class.dir = "target/classes"
grails.project.test.class.dir = "target/test-classes"
grails.project.test.reports.dir = "target/test-reports"
grails.project.target.level = 1.6
grails.project.source.level = 1.6
//grails.project.war.file = "target/${appName}-${appVersion}.war"
grails.project.ivy.authentication = {
    credentials {
        realm = "Sonatype Nexus Repository Manager"
        host = "koka1.kokaihop.se"
        username = "ig"
        password = "proto123"
    }
}
grails.project.dependency.resolution = {
    // inherit Grails' default dependencies
    inherits("global") {
        // uncomment to disable ehcache
        // excludes 'ehcache'
    }
    log "error" // log level of Ivy resolver, either 'error', 'warn', 'info', 'debug' or 'verbose'
    checksums true // Whether to verify checksums on resolve

    repositories {
        inherits true // Whether to inherit repository definitions from plugins
        grailsPlugins()
        grailsHome()
        grailsCentral()
        mavenCentral()

        // uncomment these to enable remote dependency resolution from public Maven repositories
        //mavenCentral()
        //mavenLocal()
        //mavenRepo "http://snapshots.repository.codehaus.org"
        mavenRepo "http://repository.codehaus.org"
        //mavenRepo "http://repository.jboss.com/maven2/"
        mavenRepo "http://download.java.net/maven/2/"
        //mavenRepo "http://repository.jboss.com/maven2/"
        mavenRepo "http://koka1.kokaihop.se:9091/nexus/content/groups/public"
        mavenRepo "http://m2repo.spockframework.org/snapshots"
        mavenRepo "http://repository.openmindonline.it"
        mavenRepo "http://raykrueger.googlecode.com/svn/repository"
        mavenRepo "http://files.couchbase.com/maven2"
        mavenRepo "http://grails.org/plugins"
    }
    dependencies {
        // specify dependencies here under either 'build', 'compile', 'runtime', 'test' or 'provided' scopes eg.
        runtime 'mysql:mysql-connector-java:5.1.16'
        compile 'commons-io:commons-io:1.4'
        compile 'commons-httpclient:commons-httpclient:3.1'
        compile "commons-codec:commons-codec:1.5"
        compile "org.slf4j:slf4j-api:1.6.1"
        compile "org.slf4j:jcl-over-slf4j:1.6.1"
        compile 'org.apache.axis2:axis2-kernel:1.6.1'
        compile 'org.apache.axis2:axis2-adb:1.6.1'
        compile 'org.apache.axis2:axis2-transport-http:1.6.1'
        compile 'org.apache.axis2:axis2-transport-local:1.6.1'
        runtime "info.magnolia:magnolia-module-dms:1.6", {
            exclude group: 'commons-logging', name: 'commons-logging'
            exclude 'slf4j-log4j12'
        }

        runtime "org.freehep:freehep-io:2.0.5", {
            exclude group: 'commons-logging', name: 'commons-logging'
            exclude 'slf4j-log4j12'
        }

        runtime "net.sourceforge.openutils:openutils-mgnlmedia:5.0.0", {
            exclude 'org.freehep'
            exclude group: 'commons-logging', name: 'commons-logging'
            exclude 'slf4j-log4j12'
        }
        // runtime 'mysql:mysql-connector-java:5.1.16'
    }

    plugins {
        runtime ":hibernate:$grailsVersion"
        runtime ":jquery:1.7.1"
//        runtime ":resources:1.1.6"
        compile ":console:1.1"
        compile ":maglev:0.3.4"
        compile ":jquery-ui:1.8.15"
        compile ":famfamfam:1.0.1"
        // Uncomment these (or add new ones) to enable additional resources capabilities
        //runtime ":zipped-resources:1.0"
        //runtime ":cached-resources:1.0"
        //runtime ":yui-minify-resources:0.1.4"

        build ":tomcat:$grailsVersion"
    }
}
