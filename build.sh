#!/bin/bash

# Build script for LeeGUI Docker image
# Usage: ./build.sh

set -e

IMAGE_NAME="marcelofmatos/leegui"
TAG="latest"
FULL_TAG="${IMAGE_NAME}:${TAG}"

echo "Building Docker image: ${FULL_TAG}"

# Check if Dockerfile exists
if [ ! -f "Dockerfile" ]; then
    echo "Error: Dockerfile not found"
    exit 1
fi

# Clean up old images to save space
docker image prune -f

# Build image
docker build -t ${FULL_TAG} .

# Show image info
echo "Build completed successfully!"
echo "Image size:"
docker images ${IMAGE_NAME} --format "table {{.Repository}}\t{{.Tag}}\t{{.Size}}"

echo "Ready for push: docker push ${FULL_TAG}"
