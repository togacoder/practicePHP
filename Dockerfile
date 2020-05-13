FROM php:7.3-cli-stretch

# 日本語対応
ENV LANG=C.UTF-8
ENV LANGUAGE=en_US:

ENV USER_NAME user
ENV PASSWD passwd
ENV SHELL /bin/bash
ENV HOME=/home/${USER_NAME}

RUN apt-get update \
&& apt-get install -y \
    apt-utils \
    sudo \
    vim \
&&  apt-get clean \
&&  rm -rf /var/lib/apt/lists/*

RUN echo "root:${PASSWD}" | chpasswd
RUN adduser ${USER_NAME}
RUN gpasswd -a ${USER_NAME} sudo
RUN echo "${USER_NAME}:${PASSWD}" | chpasswd

USER ${USER_NAME}
RUN mkdir ${HOME}/src
WORKDIR $HOME

COPY ./conf/.vimrc ${HOME}/.