FROM oscarortegano/rpi-docker-wordpress:latest
MAINTAINER raymond

RUN touch export-dates-and-permalinks.php /app/export-dates-and-permalinks.php

 
CMD ["/run.sh"]

