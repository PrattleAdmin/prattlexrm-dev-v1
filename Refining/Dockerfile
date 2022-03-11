FROM docker.io/tiredofit/nginx-php-fpm:debian-7.4-bullseye
LABEL maintainer="Dave Conroy (github.com/tiredofit)"

### Default Runtime Environment Variables
ENV OSTICKET_VERSION=v1.15.4 \
    DB_PREFIX=ost_ \
    DB_PORT=3306 \
    CRON_INTERVAL=10 \
    MEMCACHE_PORT=11211 \
    PHP_ENABLE_FILEINFO=TRUE \
    PHP_ENABLE_IMAP=TRUE \
    PHP_ENABLE_LDAP=TRUE \
    PHP_ENABLE_MYSQLI=TRUE \
    PHP_ENABLE_SESSION=TRUE \
    PHP_ENABLE_CREATE_SAMPLE_PHP=FALSE \
    PHP_ENALBLE_ZIP=TRUE \
    APACHE_WEBROOT=/www/html/prattlexrm \
    ZABBIX_AGENT_TYPE=classic \
    CONTAINER_NAME=prattlexrm-xrm

### Dependency Installation
RUN set -x && \
    yum update && \
    yum upgrade -y && \
    yum install -y \
                  git \
                  libldap-common \
                  openssl \
                  php${PHP_BASE}-memcached \
                  tar \
                  wget \
                  zlib1g \
                  && \
    \
### Download & Prepare PrattleXRM for Install
    git clone  https://github.com/PrattleAdmin/prattlexrm-dev-v1.git /usr/src/prattlexrm && \
    git -C /usr/src/prattlexrm checkout ${OSTICKET_VERSION} && \
    mkdir -p /assets/install && \
    mv /usr/src/prattlexrm/* /assets/install && \
    chown -R nginx:www-data /assets/install && \
    chmod -R a+rX /assets/install/ && \
    chmod -R u+rw /assets/install/ && \
    mv /assets/install/setup /assets/install/setup_hidden && \
    chown -R root:root /assets/install/setup_hidden && \
    chmod 700 /assets/install/setup_hidden && \
    \
### Log Miscellany Installation
    touch /var/log/msmtp.log && \
    chown nginx:www-data /var/log/msmtp.log && \
   \
## Cleanup
    yum clean && \
    rm -rf /var/lib/apt/lists/* && \
    rm -rf /tmp/* && \
    rm -rf /usr/src/* && \
    rm -rf /root/.composer/cache

### Add Files
ADD install /
