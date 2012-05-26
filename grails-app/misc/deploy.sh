cd ~/idc
svn revert -R .
svn up
grails clean;
grails prod war ~/ROOT.war
sudo rm -rf /var/lib/tomcat6/webapps/ROOT
sudo rm -rf /var/lib/tomcat6/work/*
sudo cp ~/ROOT.war /var/lib/tomcat6/webapps/
sudo /etc/init.d/tomcat6 restart
