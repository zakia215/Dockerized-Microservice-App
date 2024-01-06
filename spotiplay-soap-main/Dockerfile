FROM amazoncorretto:8

RUN yum update -y && yum install -y maven

WORKDIR /app

COPY . /app

RUN mvn clean package

EXPOSE 3001

ENTRYPOINT ["java", "-jar", "target/spotiplay-soap-1.0-SNAPSHOT-jar-with-dependencies.jar"]