<?php
    /**
     * Created by JetBrains PhpStorm.
     * User: Prasad
     * Date: 1/26/14
     * Time: 10:58 PM
     * To change this template use File | Settings | File Templates.
     */
?>
<div class="row">
    <div class="large-6 columns login">
        <h3>Login</h3>

        <form method="post" action="/login/">
            <div class="row">
                <div class="large-8 columns">
                    <label>What's your Email Id ?
                        <small>required</small>
                    </label>
                    <input required type="email" placeholder="Email Id" name="user_email"/>
                    <!--small class="error">Your Email Id is required.</small-->
                </div>
            </div>

            <div class="row">
                <div class="large-8 columns">
                    <label>Password
                        <small>required</small>
                    </label>
                    <input type="password" name="user_password" value="">
                    <!--small class="error">Your password must match the requirements</small-->
                </div>
            </div>
            <button type="submit">Submit</button>
        </form>
    </div>
    <div class="large-6 columns registration">
        <h3>Register</h3>

        <form method="post" action="/registration">
            <div class="row">
                <div class="large-8 columns">
                    <label>What's your name ?
                        <small>required</small>
                    </label>
                    <input required type="text" placeholder="What's your name ?" name="user_name"/>
                    <!--small class="error">Your name is required.</small-->
                </div>
            </div>

            <div class="row">
                <div class="large-8 columns">
                    <label>What's your Email Id ?
                        <small>required</small>
                    </label>
                    <input required type="email" placeholder="Email Id" name="user_email"/>
                    <!--small class="error">Your Email Id is required.</small-->
                </div>
            </div>

            <div class="row">
                <div class="large-8 columns">
                    <label>Password
                        <small>required</small>
                    </label>
                    <input type="password" name="user_password" value="">
                    <!--small class="error">Your password must match the requirements</small-->
                </div>
            </div>
            <button type="submit">Submit</button>
        </form>
    </div>