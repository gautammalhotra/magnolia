cd ~/idc
grails clean;
grails prod war ~/ROOT.war
sudo rm -rf /var/lib/tomcat6/webapps/ROOT
sudo cp ~/ROOT.war /var/lib/tomcat6/webapps/
sudo /etc/init.d/tomcat6 restart
