# Weluse's Lithium Basic Template v1.0
Oct 2011, by Mschw.
Enthält folgende Libraries:
 * li_access (weluse development branch)
 * li3_behaviors (Model Behavior capability for li3)
 * li3_dateable (created, updated on models => For mongo DB check out the mongo branch!)
 * li3_flash (Flash Messages)
 * lithium (git.weluse.de master/latest framework submit which is been merged intio githubs framework master)
 
 ##Additionals:
 * app/config/bootstrap/environment.php (setup the env, based on http_host info: .test => 'test', .local => 'development', otherwise 'production'
 * app/config/bootstrap/debug.php 
 ** sets fire_php as logger
 ** cycles through the connection definitions for inject query logging
 ** sets php env: ini_set( display_errors = 1 if not in production)
 * env.sh => source it and you'll get the li3 command trough path rewrite
 
 ##ToDo:
 * require debug.php only in test and development environment
 * switch to master repos if possible