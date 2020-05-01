FROM php:latest

RUN apt update && apt install -y \
    apt-utils \
    vim \
&&  apt clean \
&&  rm -rf /var/lib/apt/lists/*

COPY ./conf/.vimrc /root/.

# 日本語対応
ENV LANG=C.UTF-8
ENV LANGUAGE=en_US: