[![purple](https://raw.github.com/ulpmori/purple/master/purple_logo.png)](https://github.com/ulpmori/purple/)

A tiny flexible MVC framework for agile web developers with some new concepts to rapid and easier development.

[![Build Status](https://drone.io/github.com/ulpmori/purple/status.png)](https://drone.io/github.com/ulpmori/purple/latest)

-----

#### Notes & info

Purple is not production ready and is in experimental stages.

It aims to be a minimal rapid-prototype framework for general web development with pre-built tools.

Currently the Purple framework runs on a vanilla php5/apache2 system however this will drastically change to support nginx and lighttp.
In the future this aims to incorporate web servers within the framework, such as Cherrypy.

-----

#### Getting started

###### Tip: this getting started info is ont he current system. This will change completely in the future.

To get started you need to have php5 and apache web server installed.

You also need to have _curl_ installed and supported on php;

* Debian/Ubuntu

<pre><code>sudo apt-get install curl libcurl3 libcurl3-dev php5-curl

service apache2 restart
</code></pre>

* Red Hat/Fedora

<pre><code>yum install curl libcurl php5-curl

/sbin/service httpd restart
</code></pre>

###### Tip: if you are on Ubuntu then you will have [to allow .htaccess overide permission](https://help.ubuntu.com/community/EnablingUseOfApacheHtaccessFiles), if you have not already done so. Also run a2enmod php5.

-----


#### Contributers

- [@ulpmori](http://github.com/ulpmori)
