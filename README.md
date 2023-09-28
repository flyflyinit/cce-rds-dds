# Simple Helm chart deployment of an Apache/PHP stack on CCE Cluster connecting to RDS(MySQL) and DDS(MongoDB) databases
This README provides instructions for deploying an Apache/PHP stack on a CCE Cluster, with connections to RDS (MySQL) and DDS (MongoDB) databases. This deployment is achieved using Docker and Helm charts.

## Diagram
![Alt text](https://github.com/flyflyinit/cce-rds-dds/blob/main/apache-cce-dds-rds.png)

## Prerequisites
Before deploying the Apache/PHP stack on your CCE Cluster, ensure you have the following prerequisites in place:

- RDS (MySQL) Database: Set up and configure an RDS MySQL database for your application.
- DDS (MongoDB) Database: Create and configure a DDS MongoDB database for your application.
- CCE Cluster: You should have a Container Cloud Engine (CCE) Cluster provisioned and accessible.
- SWR Organization: Ensure that you have access to the SWR organization for container image storage.

### Build Docker image from Dockerfile

First, build the Docker image from the provided Dockerfile using the following command:

```
sudo docker build --tag apache-php:latest .
```

Once the image is built, you can deploy it locally on your machine using the docker run command.

### Tag container image
The Apache/PHP container image could be pushed to the SWR container registry for deployment on the CCE Cluster. Depending on your use case, choose one of the following options for tagging and pushing the image.

After obtaining the Login command and authenticating to SWR.

For inter-cluster access
```
sudo docker tag apache-php:latest registry.eu-west-0.prod-cloud-ocb.orange-business.com/SWR_organization/apache-php:latest
```

For intra-cluster access
```
sudo docker tag apache-php:latest <Intra IP address>:20202/SWR_organization/apache-php:latest
```

### Push container image
After tagging the image, push it to the SWR container registry:

```
sudo docker push registry.eu-west-0.prod-cloud-ocb.orange-business.com/SWR_organization/apache-php:latest
```
### Setup DBs environment variables
Update environment variables including Container image on SWR, MySQL and MongoDB credentials, on values.yaml
These DB vars will be passed to the PHP webpage to connect to the databases

### Deploy Helm chart on CCE
Before deploying the Helm chart on your CCE Cluster, make sure to update the container image and tag in the values.yaml file.
After authenticating to the cluster using the kubeconfig.json file, you can perform kubectl commands from your local machine on your CCE. To deploy the Helm chart, use the following command:

```
helm install simple-apache .
```

This will deploy the Apache/PHP stack on your CCE Cluster, connecting to the RDS (MySQL) and DDS (MongoDB) databases. as well the networking service to have access to your container from your CCE node.

### Access the apache server
retrieve the node ip address, and the port number.
```
http://<NODE IP>:<NODE PORT>
```

