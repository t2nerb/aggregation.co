FROM tutum/lamp:latest

RUN rm -rf /app
WORKDIR /app

# Add crontab file in the cron directory
ADD crontab /etc/cron.d/project1-cron

# Give execution rights on the cron job
RUN chmod 0644 /etc/cron.d/project1-cron

EXPOSE 80 3306
