# Base image
FROM php:7.4-apache

# Maintainer
LABEL maintainer="HuyQuach"

# Create custom user and set password
RUN useradd -m -s /bin/bash alice.nguyen && \
    echo 'root:toor' | chpasswd && \
    echo 'alice.nguyen:alice123' | chpasswd


# Install tools and SSH server
RUN apt-get update && \
    apt-get upgrade -y && \
    apt-get install -y \
        python3 \
        iputils-ping \
        wget \
        cron \
        net-tools \
        dnsutils  \
        openssh-server && \
    apt-get clean

# Prepare SSH
RUN mkdir /var/run/sshd && \
    sed -i 's/#PermitRootLogin prohibit-password/PermitRootLogin yes/' /etc/ssh/sshd_config && \
    echo 'PasswordAuthentication yes' >> /etc/ssh/sshd_config
    

# Set working directory
WORKDIR /var/www/html/

# Copy web source code
COPY . /var/www/html/

# Enable PHP error display
RUN echo "display_errors=On\nerror_reporting=E_ALL" > /usr/local/etc/php/conf.d/errors.ini

# Change ownership of web files to alice.nguyen
RUN chown -R alice.nguyen:alice.nguyen /var/www/html

# Replace Apache user from www-data to alice.nguyen
RUN sed -i 's/www-data/alice.nguyen/g' /etc/apache2/envvars

RUN mkdir -p /var/www/.secrets && \
    echo "alice.nguyen:alice123" > /var/www/.secrets/ssh.txt && \
    chown -R alice.nguyen:alice.nguyen /var/www/.secrets && \
    chmod 644 /var/www/.secrets/ssh.txt


# Expose custom port for web and SSH
EXPOSE 8000
EXPOSE 22

# Change Apache port from 80 to 8000
RUN sed -i 's/80/8000/g' /etc/apache2/ports.conf && \
    sed -i 's/:80>/:8000>/g' /etc/apache2/sites-available/000-default.conf

# === USER FLAG SETUP ===

# Copy generate-user-flag script
COPY generate-user-flag.py /home/alice.nguyen/

# Set permission and run the script as alice.nguyen
USER alice.nguyen
RUN python3 /home/alice.nguyen/generate-user-flag.py
RUN mv user.txt /home/alice.nguyen
RUN rm /home/alice.nguyen/generate-user-flag.py
RUN chmod 600 /home/alice.nguyen/user.txt


# === ROOT FLAG SETUP ===

# Switch to root
USER root
COPY generate-root-flag.py /root/
RUN python3 /root/generate-root-flag.py
RUN mv root.txt /root
RUN rm /root/generate-root-flag.py
RUN chmod 600 /root/root.txt

# === PRIVILEGE ESCALATION BACKDOOR (cron + script) ===
COPY root_executor.sh /usr/local/bin/root_executor.sh
RUN chmod +x /usr/local/bin/root_executor.sh && \
    echo "* * * * * root /usr/local/bin/root_executor.sh" >> /etc/crontab

# === SETUP FOR DOMAIN AND HEADERS ===

# Set Apache ServerName and custom headers
RUN echo "ServerName technova.vn" >> /etc/apache2/apache2.conf
RUN a2enmod headers
RUN echo 'Header set X-Powered-By "technova.vn"' >> /etc/apache2/apache2.conf

# Set hostname (optional)
RUN echo "technova.vn" > /etc/hostname

# Copy entrypoint script to start SSH + Apache
COPY entrypoint.sh /entrypoint.sh
RUN chmod +x /entrypoint.sh

# Run as root (entrypoint will manage services)
USER root

# Start SSH and Apache
ENTRYPOINT ["/entrypoint.sh"]