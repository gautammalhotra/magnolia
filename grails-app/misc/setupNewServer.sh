### When prompted for the root password of mysql, please use 123Soleil!
export PEM=~/intelligrape/idc/intelligrape.pem
export EC2_IP=184.73.171.25
ssh -i $PEM ubuntu@$EC2_IP "sudo add-apt-repository 'deb http://archive.canonical.com/ lucid partner';sudo  sed -i.dist 's,universe$,universe
multiverse,' /etc/apt/sources.list;sudo  sed -i.dist 's,universe$,universe multiverse,' /etc/apt/sources.list;sudo apt-get update";
ssh -i $PEM ubuntu@$EC2_IP "sudo apt-get install -y sun-java6-jdk mysql-server apache2 subversion groovy unzip tomcat6"

ssh -i $PEM ubuntu@$EC2_IP "wget http://dist.codehaus.org/grails/grails-1.3.1.zip; unzip grails-1.3.1.zip"

ssh -i $PEM ubuntu@$EC2_IP "svn --username vivek --password igdefault co
http://svn.idc.intelligrape.net/idc"

ssh -i $PEM ubuntu@$EC2_IP "sudo cp ~/idc /etc/apache2/sites-available/"

ssh -i $PEM ubuntu@$EC2_IP "sudo a2enmod rewrite headers proxy proxy_http"
ssh -i $PEM ubuntu@$EC2_IP "sudo apache2ctl restart"
ssh -i $PEM ubuntu@$EC2_IP "mysql --user=root --password=igdefault < ~/irofoot/misc/createProdUser.sql;"
ssh -i $PEM ubuntu@$EC2_IP "cat ~/irofoot/misc/.userSettings|cat - ~/.bashrc > /tmp/out && mv /tmp/out ~/.bashrc"



##### You need to execute the greatest database dump ######## 
#### You need to run "grails run-app" as ubuntu user at this step so that all the plugins can be downloaded and installed ###
### Now execute this command : ssh -i $PEM ubuntu@$EC2_IP "~/irofoot/misc/deploy.sh"
