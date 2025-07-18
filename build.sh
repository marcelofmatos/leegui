#!/bin/bash

# Build script for LeeGUI Docker image
# Usage: ./build.sh [FULL_TAG]

set -e

FULL_TAG="${1:-marcelofmatos/leegui:latest}"

# Validate FULL_TAG format
if [[ ! "${FULL_TAG}" =~ ^[a-zA-Z0-9._/-]+:[a-zA-Z0-9._-]+$ ]]; then
    echo "Error: Invalid tag format. Use format: repository:tag"
    exit 1
fi

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
docker images ${FULL_TAG} --format "table {{.Repository}}\t{{.Tag}}\t{{.Size}}"

echo "Ready for push: docker push ${FULL_TAG}"
