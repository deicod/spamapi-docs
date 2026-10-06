//go:build ignore

package main

import (
	"bytes"
	"encoding/json"
	"fmt"
	"net/http"
	"os"
)

func main() {
	apiKey := os.Getenv("SPAMAPI_KEY")
	payload := map[string]any{
		"api_key":         apiKey,
		"blog":            "https://example.com",
		"user_ip":         "203.0.113.10",
		"user_agent":      "Mozilla/5.0",
		"comment_content": "Buy cheap pills...",
		"is_test":         false,
	}

	body, _ := json.Marshal(payload)
	req, _ := http.NewRequest(http.MethodPost, "https://spamapi.de/api/v1/check", bytes.NewReader(body))
	req.Header.Set("Content-Type", "application/json")
	req.Header.Set("X-API-Key", apiKey)

	res, err := http.DefaultClient.Do(req)
	if err != nil {
		panic(err)
	}
	defer res.Body.Close()

	var out any
	_ = json.NewDecoder(res.Body).Decode(&out)
	fmt.Println(res.StatusCode, out)
}
