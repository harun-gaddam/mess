const express = require('express');
const webpush = require('web-push');
const bodyParser = require('body-parser');

const app = express();
app.use(bodyParser.json());

const publicVapidKey = 'YOUR_PUBLIC_VAPID_KEY';
const privateVapidKey = 'YOUR_PRIVATE_VAPID_KEY';

webpush.setVapidDetails('mailto:harunharry7@.com', publicVapidKey, privateVapidKey);

let subscriptions = [];

app.post('/subscribe', (req, res) => {
  const subscription = req.body;
  subscriptions.push(subscription);
  res.status(201).json({ message: 'Subscription created' });
});

app.post('/send-notification', (req, res) => {
  const notificationPayload = {
    notification: {
      title: 'New Mess Menu Available',
      body: 'Check out the latest menu in the Mess App!',
      icon: 'icon.png'
    }
  };

  Promise.all(subscriptions.map(sub => webpush.sendNotification(sub, JSON.stringify(notificationPayload))))
    .then(() => res.status(200).json({ message: 'Notification sent successfully' }))
    .catch(err => res.status(500).json({ error: err.message }));
});

const PORT = process.env.PORT || 5000;
app.listen(PORT, () => console.log(`Server started on port ${PORT}`));
