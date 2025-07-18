#!/bin/bash
# Fix PackageManifest.php for Composer 2 compatibility

MANIFEST_FILE="vendor/laravel/framework/src/Illuminate/Foundation/PackageManifest.php"

if [ -f "$MANIFEST_FILE" ]; then
    echo "Applying PackageManifest.php fix..."
    
    # Backup original file
    cp "$MANIFEST_FILE" "$MANIFEST_FILE.backup"
    
    # Apply fix for both Composer 1 and 2 compatibility
    sed -i 's/\$packages = json_decode(\$this->files->get(\$path), true);/\$installed = json_decode(\$this->files->get(\$path), true);\n        \$packages = \$installed[\x27packages\x27] ?? \$installed;/' "$MANIFEST_FILE"
    
    echo "PackageManifest.php fixed successfully"
else
    echo "PackageManifest.php not found, skipping fix"
fi
