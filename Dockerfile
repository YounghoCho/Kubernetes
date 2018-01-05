# Base Image
FROM nginx

# Set the author 
MAINTAINER Youngho Jo <dodghek1@naver.com> 

# Remove index.html existed originally
RUN rm /usr/share/nginx/html/index.html

# Copy new source code from Github
COPY Kubernetes /usr/share/nginx/html

# Set the current working directory 
WORKDIR /usr/share/nginx/html

# Expose port 
EXPOSE 80 