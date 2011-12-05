# Weluse's Lithium Basic Template v1.1
Since Oct 2011, by Mschw.

##Using libraries:
 * li_access (weluse development branch)
 * li3_behaviors (Model Behavior capability for li3)
 * li3_dateable (created, updated on models => For mongo DB check out the mongo branch!)
 * li3_flash (Flash Messages)
 * lithium (git.weluse.de master/latest framework submit which is been merged intio githubs framework master)
 
 ##Additionals:
 * Since v1.1
 ** using sass:  app/webroot/sass => install compass!
 ** unsing php locale ability: => see Section Locale and app/config/bootstrap/environment.php
 * app/config/bootstrap/environment.php (setup the env, based on http_host info: .test => 'test', .local => 'development', otherwise 'production'
 * app/config/bootstrap/debug.php 
 ** sets fire_php as logger
 ** cycles through the connection definitions for inject query logging
 ** sets php env: ini_set( display_errors = 1 if not in production)
 * env.sh => source it and you'll get the li3 command through path rewrite
 
 ### Installing Locales under Ubuntu:
 - apt-get install language-pack-de-base
 - apt-get install language-pack-de
 - apt-get install locales

 ##ToDo:
 * require debug.php only in test and development environment
 * switch to master repos if possible