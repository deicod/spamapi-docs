// Node.js 24 provides fetch; no npm packages are needed.
const apiKey = process.env.SPAMAPI_KEY;
if (!apiKey) {
  throw new Error("Set SPAMAPI_KEY to your SpamAPI dashboard API key (spa_...).");
}
const res = await fetch("https://spamapi.de/api/v1/check", {
  method: "POST",
  headers: {
    "Content-Type": "application/json",
    "X-API-Key": apiKey,
  },
  body: JSON.stringify({
    blog: "https://example.com",
    user_ip: "203.0.113.10",
    user_agent: "Mozilla/5.0",
    comment_content: "Buy cheap pills...",
    is_test: false,
  }),
});

const data = await res.json();
console.log(res.status, data);
