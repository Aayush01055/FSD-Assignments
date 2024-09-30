import express from 'express';
const app = express();
import bodyParser from 'body-parser';
import mongoose from 'mongoose';
import cors from 'cors';

app.use(bodyParser.json());
app.use(cors());

mongoose.connect('mongodb://localhost:27017/User', { useNewUrlParser: true, useUnifiedTopology: true });
 //mongoose.connect('mongodb+srv://Aayush:Aayush@sandbox.ejckoqt.mongodb.net/User?retryWrites=true&w=majority&appName=Sandbox');

const userSchema = new mongoose.Schema({
  fname:String,
  lname:String,
  email: String,
  password: String
});

const User = mongoose.model('login_user', userSchema);

app.post('/register', async (req, res) => {
  try {
    const { fname,lname,email, password } = req.body;
    if (!email || !password || !fname || !lname) {
      return res.status(400).send({ error: 'Enter Valid Data / Data is Missing' });
    }

    const existingUser = await User.findOne({ email });
    if (existingUser) {
      return res.status(400).send({ error: 'Email Already Exists' });
    }

    const user = new User({ fname,lname,email, password });
    await user.save();
    res.send({ message: 'User created successfully with name '+fname + " " + lname +" and username "+email });
  } catch (err) {
    console.error(err);
    res.status(500).send({ error: 'Internal Server Error' });
  }
});

app.post('/login', async (req, res) => {
  try {
    const { email, password } = req.body;
    if (!email || !password) {
      return res.status(400).send({ error: 'Email and Password are Required' });
    }

    const user = await User.findOne({ email });
    if (!user) {
      return res.status(401).send({ error: 'Invalid Email or Password' });
    }

    if (user.password !== password) {
      return res.status(401).send({ error: 'Invalid Email or Password' });
    }

    //res.send({ message: 'Log in successfull for user '+user.fname+" "+user.lname });
    res.status(200).send({ message: 'Log in successful'});
  } catch (err) {
    console.error(err);
    res.status(500).send({ error: 'Internal Server Error' });
  }
});

app.get('/users', async (req, res) => {
  try {
    //prompt for getting username from user

    const users = await User.find();
    //print users on cmd
    console.log(users);
    res.send(users);
  } catch (err) {
    console.error(err);
    res.status(500).send({ error: 'Internal Server Error' });
  }
}
);

app.listen(5000, () => {
  console.log('Server started on port 5000');
});