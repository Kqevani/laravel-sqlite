FROM node:22

RUN apt update  && \
    apt install libgtk2.0-0 libgtk-3-0 libgbm-dev libnotify-dev libnss3 libxss1 libasound2 libxtst6 xauth xvfb -y && \
    apt clean && \
    rm -rf /var/lib/apt/lists/*
