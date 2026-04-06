import argparse
import json
import os
from datetime import datetime

def process_video(source_path):
    laravel_public_storage = os.path.abspath(os.path.join(os.path.dirname(__file__), '..', 'storage', 'app', 'public', 'violations'))
    os.makedirs(laravel_public_storage, exist_ok=True)

    vehicle_count = 23
    violations_found = []

    timestamp_str = datetime.now().strftime("%Y%m%d_%H%M%S")
    image_filename = f"violation_{timestamp_str}_mock.jpg"
    rider_filename = f"rider_{timestamp_str}_mock.jpg"

    with open(os.path.join(laravel_public_storage, image_filename), 'w') as f:
        f.write("mock image content")
        
    violations_found.append({
        "plate": "MH12AB1234",
        "conf": 0.92,
        "image": image_filename,
        "rider_image": rider_filename
    })

    output_data = {
        "vehicle_count": vehicle_count,
        "violations": violations_found
    }

    print(json.dumps(output_data))

if __name__ == "__main__":
    parser = argparse.ArgumentParser(description="Traffic Detection CLI")
    parser.add_argument("--source", required=True, help="Path to input video file")
    args = parser.parse_args()

    process_video(args.source)
