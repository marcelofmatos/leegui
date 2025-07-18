#!/bin/bash

# Build comparison script
# Tests different Dockerfile versions for speed

echo "=== Docker Build Speed Comparison ==="
echo

# Build with current Ubuntu (default)
echo "🚀 Building with Ubuntu (default)..."
time ./build.sh marcelofmatos/leegui:ubuntu Dockerfile

echo
echo "🐌 Building with Alpine (slim)..."
time ./build.sh marcelofmatos/leegui:alpine Dockerfile.slim

echo
echo "⚡ Building with ultra-fast pre-built image..."
time ./build.sh marcelofmatos/leegui:ultrafast Dockerfile.ultrafast

echo
echo "=== Size Comparison ==="
docker images marcelofmatos/leegui --format "table {{.Repository}}\t{{.Tag}}\t{{.Size}}\t{{.CreatedAt}}"

echo
echo "=== Recommendations ==="
echo "• Ubuntu (default): Faster build, good balance"
echo "• Alpine (slim): Smaller size, slower build"
echo "• Ultra-fast: Fastest build, dependencies on external image"
