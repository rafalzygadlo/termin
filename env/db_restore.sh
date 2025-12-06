sudo docker exec $1 mariadb -u root --password=pwd db < backup.sql
