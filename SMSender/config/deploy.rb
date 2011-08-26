#Required settings
#Set application to the url of the project
set :user, "root"
set :application, "500smsgratis"

#Set repository is the path to the Git repository to deploy from. Capistrano will ssh into the server,
#so the user specified below must be able to ssh into the server
set :repository, "git@github.com:querox/Proyectos-Generales-PHP.git"

#Roles
#Roles are named sets of servers that you can target Capistrano tasks to execute against.
role :web, "500smsgratis.com"
role :app, "500smsgratis.com"

#Optional Settings
#This allows Capistrano to prompt for passwords
default_run_options[:pty] = true

#The following lines tell Capistrano where to deploy the project
set :deploy_to, "/var/www/vhosts/500smsgratis.com"
set :current_path, "#{deploy_to}/httpdocs"
set :releases_path, "#{deploy_to}/releases/"
set :shared_path, "#{deploy_to}/shared/"

set :current_dir, "httpdocs" #the directory where you want releases to symlink
set :site_root, "#{deploy_to}/#{current_dir}/" #wherever you want files to be served from
set :keep_releases, 5

#This tells Capistrano that I'm using Git for versioning.
set :scm, :git

#This tells Capistrano that sudo access is not needed to deploy the project.
set :use_sudo, false

#Subdirectorio que contiene la aplicacion en el repositorio
set :app_dir, "SMSender"

#Directorio que se usara para hacer backup temporario del release - eliminado al finalizar el update
set :back_dir, "SMSender_release_backup"

#And here are the tasks required to deploy a simple project
namespace:deploy do
    task:start do
    end
    task:stop do
    end
    task:finalize_update do
        run "chmod -R g+w #{release_path}"
        #Mover contenido del subdirectorio de la aplicacion a directorio de backup
        run "mkdir #{back_dir} && mv #{release_path}/#{app_dir}/* #{back_dir}"
        #Recrear directorio de release y mover el contenido desde el backup
        run "rm -rf #{release_path} && mkdir #{release_path} && mv #{back_dir}/* #{release_path}"
        #Elinar directorio de backup
        run "rm -rf #{back_dir}"
    end
    task:restart do
    end
   after "deploy:restart" do
         #add any tasks in here that you want to run after the project is deployed
         run "rm -rf #{release_path}.git"
   end
end
