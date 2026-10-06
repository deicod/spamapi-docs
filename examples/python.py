import os
import requests

api_key = os.getenv("SPAMAPI_KEY")

payload = {
    "api_key": api_key,
    "blog": "https://example.com",
    "user_ip": "203.0.113.10",
    "user_agent": "Mozilla/5.0",
    "comment_content": "Buy cheap pills...",
    "is_test": False,
}

resp = requests.post(
    "https://spamapi.de/api/v1/check",
    headers={"X-API-Key": api_key},
    json=payload,
    timeout=10,
)

print(resp.status_code, resp.json())
